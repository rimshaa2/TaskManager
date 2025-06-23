pipeline {
    agent any

    environment {
        PROJECT_NAME = 'taskmanager_jenkins'
        COMPOSE_FILE = 'docker-compose.ci.yml'
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/rimshaa2/TaskManager.git'
            }
        }

        stage('Build and Run with Docker') {
            steps {
                sh "docker-compose -p ${PROJECT_NAME} -f ${COMPOSE_FILE} up -d --build"
            }
        }
        stage('Cleanup'){
            steps {
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down -v --remove-orphans || true'
              }
        }
        stage('Build and Deploy') {
              steps {
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE build'
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE up -d'
              }
            }
        stage('Status') {
              steps {
                sh 'docker ps'
              }
            }
    }
}

