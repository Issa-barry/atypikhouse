build:
	sudo git pull && sudo docker compose build app --no-cache --force-rm
	
stop:
	sudo docker compose stop

up:
	sudo docker compose up 