# For running tests
FROM markhobson/maven-chrome
COPY . /usr/src/app
WORKDIR /usr/src/app
RUN mvn test
