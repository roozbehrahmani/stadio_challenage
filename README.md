<p align="center">
<img src="https://img.shields.io/badge/-PHP-777BB4?style=for-the-badge&logo=PHP&logoColor=777BB4&labelColor=282828">
<img src="https://img.shields.io/badge/-Laravel-FF2D20?style=for-the-badge&logo=Laravel&logoColor=FF2D20&labelColor=282828">
<img src="https://img.shields.io/badge/-Docker-2496ED?style=for-the-badge&logo=Docker&logoColor=2496ED&labelColor=282828">
<img src="https://img.shields.io/badge/-Redis-DC382D?style=for-the-badge&logo=Redis&logoColor=DC382D&labelColor=282828">
<img src="https://img.shields.io/badge/-ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=E95420&labelColor=282828">
</p>

----------------

###  Stadio challenge

You can see the description of the challenge from this [link](https://you.s3.ir-thr-at1.arvanstorage.ir/backend-challenge.pdf)

----------------

### :arrow_down: Installation guide

Enter the following commands in your terminal:

```shell
git clone https://github.com/imvahid/arvancloud-challenge.git
```
```shell
cd arvancloud-challenge
```
```shell
make up
```
```shell
make migrate
```
```shell
make seed
```

You can see the database from [127.0.0.1:5000](http://127.0.0.1:5000) link.
- Username: root
- Password: password

----------------

### :book: List of APIs

You can use the following command to view the list of APIs:

```shell
make route
```

Or use a `postman` file [postman_collection](arvancloud-challenge.postman_collection.json) is placed in the project to access the APIs.

----------------

### :tv: Demo video

You can see original video from this [link](https://you.s3.ir-thr-at1.arvanstorage.ir/demo-video.webm)

<p><img src="https://you.s3.ir-thr-at1.arvanstorage.ir/demo-video.gif?raw=true"></p>

----------------

### :heavy_check_mark: Other commands

Complete list of commands to use when running the program:

| Command      | Description                                                 |
|--------------|-------------------------------------------------------------|
| make up      | Create and start containers                                 |
| make down    | Stop and remove resources                                   |
| make build   | Build or rebuild services                                   |
| make test    | Run `php artisan test` command on `arvancloud` container    |
| make migrate | Run `php artisan migrate` command on `arvancloud` container |
| make seed    | Run `php artisan test` command on `arvancloud` container    |
| make mysql   | Go to `mysql` container's `bash`                            |
| make redis   | Go to `redis` container's `bash`                            |
| make env     | Show `.env` file from `arvancloud` container                |
| make route   | Show `route list` from `arvancloud` container               |

----------------

### :man_technologist: Author

- [Github](https://github.com/imvahid)
- [linkedin](https://www.linkedin.com/in/imvahid)
