pipeline {
    agent any

    environment {
        PROJECT_NAME = 'taskmanager_jenkins'
        COMPOSE_FILE = 'docker-compose.yml'
        TEST_REPO = 'https://github.com/rimshaa2/taskmanager-tests.git'
    }

    stages {
        stage('Clean Up Previous Containers') {
            steps {
                // Try to stop and remove old containers (ignore errors)
                sh '''
                    docker rm -f taskmanager_db || true
                    docker rm -f taskmanager_web || true
                    docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down || true
                '''
            }
        }

        stage('Build and Run App with Docker') {
            steps {
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE up -d --build'
                sh 'sleep 10'  // Wait for DB and web server
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
            echo 'Cleaning up containers...'
            sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down || true'
        }
    }
}



