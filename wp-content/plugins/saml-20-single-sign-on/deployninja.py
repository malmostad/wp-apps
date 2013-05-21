#!/usr/bin/env python

"""
DeployNinja
Utility for deploying code to multiple environments.
Author: ado.b (echo@ado.io)

@todo: remote to remote
@todo: clean-slate
@todo: run-commands-before & after
"""

import sys, os, shutil, subprocess, socket
from optparse import OptionParser

class DeployNinja(object):
  (ENV,OPT) = ("environments","options")
  (SOURCE,TARGET) = ("source","target")
  (CONFIRM,USER,HOST,PATH) = ("confirm","user","host","path")
  CONFIRM_DEFAULT = False
  MSG_ABORT = "Operation aborted..."
  
  def __init__(self, settings):
    self.setOptions(settings)


  def run(self):
    if self.askForConfirmation() is False:
      self.notify(self.MSG_ABORT)
      sys.exit()
    try:
      self.transfer()
      return self
    except KeyboardInterrupt:
      self.notify(self.MSG_ABORT)


  def setOptions(self, settings):
    environments = settings[self.ENV]
    parser = OptionParser();
    parser.add_option(
      "-e", "--environment", 
      dest="env",
      help="Sets the environment", 
      type="choice", 
      choices=self.getEnvChoices(environments)
    )
    (opt, args) = parser.parse_args()
    if opt.env not in environments:
      sys.exit(
        "Specify environment please: " + 
        ", ".join(self.getEnvChoices(environments))
      )
    self.env = environments[opt.env]
    self.options = settings[self.OPT];
    return self


  def askForConfirmation(self):
    if(self.CONFIRM in self.env): 
      self.notify(self.env[self.CONFIRM])
      prompt = "%s [%s] | %s: " % ("Confirm deploy", "n", "y")
      while True:
        answer = raw_input(prompt)
        if not answer: return self.CONFIRM_DEFAULT
        if answer not in ['y', 'n']:
          self.notify('Enter y or n.')
          continue
        if answer == 'y': return True
        if answer == 'n': return False
    else: return True


  def getEnvChoices(self, environments):
    choices = [];
    for key in environments: choices.append(key)
    return choices


  def buildURI(self, parts):
    uri = ""
    if self.USER in parts: uri += parts[self.USER] + "@"
    if self.HOST in parts: uri += parts[self.HOST] + ":"
    uri += parts[self.PATH]
    return uri


  def transfer(self):
    src = self.env[self.SOURCE]
    trg = self.env[self.TARGET]
    self.notify("Deploying to " + trg.get(self.HOST, socket.gethostname()))
    cmd  = [
      "rsync", 
      "-e ssh", 
      "--perms", 
      "--progress", 
      "--recursive", 
      "--times", 
      "--links", 
      "--delete-excluded", 
    ]
    for ignore in self.options["ignore"]: 
      cmd.extend(["--exclude", ignore])
    self.execute(cmd + [self.buildURI(src) + "/", self.buildURI(trg)])
    return self


  def notify(self, msg):
    print msg


  def execute(self, command):
    proc = subprocess.Popen(
      command,
      stdin=subprocess.PIPE,
      stdout=subprocess.PIPE,
      stderr=subprocess.PIPE
    )
    out,err = proc.communicate()
    if err: self.notify("Errors:\n" +err+"\n=====================\n")
    if out: self.notify("Output:\n" +out+"\n=====================\n")
    return self
