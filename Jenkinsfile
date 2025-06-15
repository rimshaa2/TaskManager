pipeline {
    agent any

    environment {
        PROJECT_NAME = 'taskmanager_jenkins'
        COMPOSE_FILE = 'docker-compose.yml'
    }

    stages {
       stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/rimshaa2/TaskManager.git'
            }
        }


        stage('Build and Run with Docker') {
            steps {
                //sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE up -d --build'
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE up -d --build'
            }
        }
    }

    post {
        always {
            echo 'Cleaning up...'
            sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down'
            //sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down'
        }
    }
}