#!/bin/bash

# Destination of env file inside container
ENV_FILE="/var/www/laravel/current/.env"

# Loop through XDEBUG, PHP_IDE_CONFIG and REMOTE_HOST variables and check if they are set.
# If they are not set then check if we have values for them in the env file, if the env file exists. If we have values
# in the env file then add exports for these in in the ~./bashrc file.
echo "export USER=root" >> ~/.bashrc;
for VAR in XDEBUG PHP_IDE_CONFIG REMOTE_HOST AWS_ACCESS_KEY_ID AWS_SECRET_ACCESS_KEY AWS_DEFAULT_REGION
do
  if [ -z "${!VAR}" ] && [ -f "${ENV_FILE}" ]; then
    VALUE=$(grep $VAR $ENV_FILE | cut -d '=' -f 2-)
    if [ ! -z "${VALUE}" ]; then
      # Before adding the export we clear the value, if set, to prevent duplication.
      sed -i "/$VAR/d"  ~/.bashrc
      echo "export $VAR=$VALUE" >> ~/.bashrc;
    fi
  fi
done

# If there is still no value for the REMOTE_HOST variable then we set it to the default of host.docker.internal. This
# value will be sufficient for windows and mac environments.
if [ -z "${REMOTE_HOST}" ]; then
  REMOTE_HOST=host.docker.internal
  sed -i "/REMOTE_HOST/d"  ~/.bashrc
  echo "export REMOTE_HOST=\"$REMOTE_HOST\"" >> ~/.bashrc;
fi

# If there is still no value for the PHP_IDE_CONFIG variable then we set it to the default of serverName=DockerApp. This
# value will be sufficient for windows and mac environments.
if [ -z "${PHP_IDE_CONFIG}" ]; then
  PHP_IDE_CONFIG="serverName=DockerApp"
  sed -i "/PHP_IDE_CONFIG/d"  ~/.bashrc
  echo "export PHP_IDE_CONFIG=\"$PHP_IDE_CONFIG\"" >> ~/.bashrc;
fi

# If there is still no value for the XDEBUG variable then we set it to the default of true. This
# value will be sufficient for windows and mac environments.
if [ -z "${XDEBUG}" ]; then
  XDEBUG="false"
  sed -i "/XDEBUG/d"  ~/.bashrc
  echo "export XDEBUG=\"$XDEBUG\"" >> ~/.bashrc;
fi

# Source the .bashrc file so that the exported variables are available.
. ~/.bashrc

# Start the cron service.
service cron start
echo "Environment variable done"
# Toggle xdebug
if [ "true" == "$XDEBUG" ]; then
    echo "Xdebug config"
  # Remove PHP_IDE_CONFIG from cron file so we do not duplicate it when adding below
  sed -i '/PHP_IDE_CONFIG/d' /etc/cron.d/laravel-scheduler
  if [ ! -z "${PHP_IDE_CONFIG}" ]; then
    # Add PHP_IDE_CONFIG to cron file. Cron by default does not load enviromental variables. The server name, set here, is
    # used by PHPSTORM for path mappings
    echo -e "PHP_IDE_CONFIG=\"$PHP_IDE_CONFIG\"\n$(cat /etc/cron.d/laravel-scheduler)" > /etc/cron.d/laravel-scheduler
  fi
  # Set up the docker-php-ext-xdebug.ini file with the required xdebug settings
  echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
  echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
  echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
  echo "xdebug.client_host=$REMOTE_HOST" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;

elif [ "false" == "$XDEBUG" ]; then
    echo "No Xdebug config"
  # Remove PHP_IDE_CONFIG from cron file if already added
  sed -i '/PHP_IDE_CONFIG/d' /etc/cron.d/laravel-scheduler
  # Remove Xdebug config file disabling xdebug
  rm -rf /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
fi
touch /var/www/.bit4id/up11/up11.exe.log
chown  www-data 1000 /var/www/.bit4id/up11/up11.exe.log
chmod -R 7777 /var/www/.bit4id
runuser -u  www-data -- /var/www/laravel/current/docker/php-fpm/linux/up11/bin/up11.exe &
exec "$@"
