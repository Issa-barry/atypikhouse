pull:
	sudo git pull
build:
	sudo docker compose build app --no-cache --force-rm
	
stop:
	sudo docker compose stop

up:
	sudo docker compose up -d