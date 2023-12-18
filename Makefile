build:
	docker compose build --no-cache --force-rm
stop:
	docker compose stop
up:
	docker compose up -d 
compose-update:
	docker exec atypikhouse bash -c "compose update"