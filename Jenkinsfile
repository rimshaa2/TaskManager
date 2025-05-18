pipeline {
    agent any

    environment {
        DOCKER_HUB_USER = 'rimshaa2'
        IMAGE_NAME = 'taskmanager'
    }

    stages {
        stage('Clone Repository') {
            steps {
                git 'https://github.com/rimshaa2/TaskManager'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t $DOCKER_HUB_USER/$IMAGE_NAME .'
            }
        }

        stage('Push to Docker Hub') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'dockerhub-creds', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
                    sh 'echo $PASSWORD | docker login -u $USERNAME --password-stdin'
                    sh 'docker push $DOCKER_HUB_USER/$IMAGE_NAME'
                }
            }
        }

        stage('Deploy via Docker Compose') {
            steps {
                sh '''
                    docker-compose down || true
                    docker-compose pull
                    docker-compose up -d
                '''
            }
        }
    }
}
