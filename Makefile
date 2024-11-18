.PHONY: setup start test deploy

setup:
	cd /backend && composer install
	cd /frontend && npm install

start:
	docker-compose up -d

test:
	cd /backend && php artisan test
	cd /frontend && npm run test

deploy:
	git push origin main