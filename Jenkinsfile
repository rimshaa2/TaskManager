pipeline {
    agent any

    environment {
        PROJECT_NAME = 'taskmanager_jenkins'
        COMPOSE_FILE = 'docker-compose.yml'
        TEST_REPO = 'https://github.com/yourusername/taskmanager-tests.git'
    }

    stages {
        stage('Clone App Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/rimshaa2/TaskManager.git'
            }
        }

        stage('Build and Run App with Docker') {
            steps {
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE up -d --build'
                sh 'sleep 10'  // wait for app & DB to initialize
            }
        }

        stage('Clone and Run Selenium Tests') {
            steps {
                sh 'git clone $TEST_REPO tests'
                dir('tests') {
                    sh 'docker build -t selenium-tests .'
                    sh 'docker run --network="host" selenium-tests'
                }
            }
        }
    }

    post {
        always {
            echo 'Cleaning up...'
            sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down'
        }
    }
}

