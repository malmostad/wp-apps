#!/usr/bin/env bash
#
# This bootstraps Puppet on Ubuntu
#
set -e

# Silence locale warnings during provisioning
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8
locale-gen en_US.UTF-8 >/dev/null

# Load up the release information
. /etc/lsb-release

REPO_DEB_URL="http://apt.puppetlabs.com/puppetlabs-release-${DISTRIB_CODENAME}.deb"

if [ "$(id -u)" != "0" ]; then
  echo "This script must be run as root." >&2
  exit 1
fi

echo "Initial apt-get update ..."
apt-get update >/dev/null

# Install the PuppetLabs repo
echo "Configuring PuppetLabs repo..."
repo_deb_path=$(mktemp)
wget --output-document="${repo_deb_path}" "${REPO_DEB_URL}" 2>/dev/null
dpkg -i "${repo_deb_path}" >/dev/null
apt-get update >/dev/null

# Install Puppet
echo -e "\nNotice: Warnings from Puppet are expected\n"
echo "Installing Puppet..."
DEBIAN_FRONTEND=noninteractive apt-get -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" install puppet >/dev/null

# Adapt Puppet to it's own requirements ...
touch /etc/puppet/hiera.yaml >/dev/null

echo "Installing Puppet modules"
wget https://github.com/malmostad/puppet-mcommons/archive/master.tar.gz -O malmo-mcommons.tar.gz 2>/dev/null
puppet module install malmo-mcommons.tar.gz
rm malmo-mcommons.tar.gz >/dev/null

# Vagrant use vagrant.pp for Puppet provisioning
# Use server.pp if we are not in a Bagrant box
if ! [ -e "/vagrant" ]
then
  echo "Starting Puppet provisioning defined in server.pp"
  puppet apply server.pp
fi
