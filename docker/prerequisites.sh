#!/bin/sh

type prerequisites >/dev/null 2>&1 || {
    sudo apt-get update -y;

    sudo apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common \
    python \
    nscd \
    pv \
    make \
    build-essential;

    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -;
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -;

    sudo add-apt-repository \
    "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
    $(lsb_release -cs) \
    stable";

    sudo apt-get update -y;

    sudo apt-get install -y docker-ce;

    sudo usermod -aG docker $(whoami);

    sudo nscd -i group;

    sudo service docker restart;

    sudo curl -L https://github.com/docker/compose/releases/download/1.29.2/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose;

    sudo chmod +x /usr/local/bin/docker-compose;

    # Precausions: this command prunes all your container
    docker system prune --force --all;

    docker network create alphacloudnet;

    touch ~/.profile;
}

