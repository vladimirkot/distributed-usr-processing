FROM rabbitmq:3-management

ARG RABBITMQ_USER_ARG
ARG RABBITMQ_PASSWORD_ARG
ARG RABBITMQ_VHOST_ARG
ARG RABBITMQ_CREATE_EXCHANGE_ARG
ARG RABBITMQ_INDEX_EXCHANGE_ARG
ARG RABBITMQ_CREATE_QUEUE_ARG
ARG RABBITMQ_INDEX_QUEUE_ARG

COPY ./definitions.json /etc/rabbitmq/definitions.json

# Add structure definitions file to config
RUN echo "management.load_definitions = /etc/rabbitmq/definitions.json"

RUN sed -i "s|\$RABBITMQ_USER|$RABBITMQ_USER_ARG|g" /etc/rabbitmq/definitions.json
RUN sed -i "s|\$RABBITMQ_PASSWORD|$RABBITMQ_PASSWORD_ARG|g" /etc/rabbitmq/definitions.json
RUN sed -i "s|\$RABBITMQ_VHOST|$RABBITMQ_VHOST_ARG|g" /etc/rabbitmq/definitions.json

RUN sed -i "s|\$RABBITMQ_CREATE_EXCHANGE|$RABBITMQ_CREATE_EXCHANGE_ARG|g" /etc/rabbitmq/definitions.json
RUN sed -i "s|\$RABBITMQ_INDEX_EXCHANGE|$RABBITMQ_INDEX_EXCHANGE_ARG|g" /etc/rabbitmq/definitions.json

RUN sed -i "s|\$RABBITMQ_CREATE_QUEUE|$RABBITMQ_CREATE_QUEUE_ARG|g" /etc/rabbitmq/definitions.json
RUN sed -i "s|\$RABBITMQ_INDEX_QUEUE|$RABBITMQ_INDEX_QUEUE_ARG|g" /etc/rabbitmq/definitions.json