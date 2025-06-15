pipeline {
    agent any

    environment {
        PROJECT_NAME = 'taskmanager_jenkins'
        COMPOSE_FILE = 'docker-compose.yml'
        TEST_REPO = 'https://github.com/rimshaa2/taskmanager-tests.git'
    }

    stages {
        stage('Clean and Build with Docker') {
            steps {
                // Clean up any leftovers
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE down || true'

                // Rebuild and run containers
                sh 'docker-compose -p $PROJECT_NAME -f $COMPOSE_FILE up -d --build'

                // Wait for app & DB to be ready
                sh 'sleep 10'
            }
        }

        stage('Clone and Run Selenium Tests') {
            steps {
                // Clone the test repo
                sh 'git clone "$TEST_REPO" tests'

                // Move into the tests directory
                dir('tests') {
                    // Build Docker image for tests
                    sh 'docker build -t selenium-tests .'

                    // Run test container with host networking (for Linux-based EC2)
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


