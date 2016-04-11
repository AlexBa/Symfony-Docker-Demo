# Pull apache base image
FROM teamrock/apache2:production

# Add the maintainer
MAINTAINER Your Name <yourname@example.com>

# Install all required components
RUN DEBIAN_FRONTEND=noninteractive apt-get update -y
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y build-essential php5-imagick php5-gd php5-intl php5-mcrypt php5-apcu php5-curl php5-mysql nano

# Make the container compatible with nano
ENV TERM xterm

# Copy the application into the public web directory
ADD src/ /var/www/
WORKDIR /var/www

# Add our virtual-host.conf
ADD config/apache/vhost.conf /etc/apache2/sites-enabled/0-virtual-host.conf

# Add our initialisation script
ADD config/symfony/setup.sh /tmp/setup.sh

# Expose the web port
EXPOSE 80

# Commands we need in order to say BOOM
ENTRYPOINT [ "/bin/bash", "/tmp/setup.sh" ]
