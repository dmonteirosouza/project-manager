FROM node:lts-alpine

WORKDIR /app

COPY . .

COPY .docker/node/npm.sh /tmp

RUN chmod +x /tmp/npm.sh

ENTRYPOINT ["/tmp/npm.sh"]
