<p align="center">
<img src="https://img.shields.io/badge/-PHP-777BB4?style=for-the-badge&logo=PHP&logoColor=777BB4&labelColor=282828">
<img src="https://img.shields.io/badge/-Laravel-FF2D20?style=for-the-badge&logo=Laravel&logoColor=FF2D20&labelColor=282828">
<img src="https://img.shields.io/badge/-Docker-2496ED?style=for-the-badge&logo=Docker&logoColor=2496ED&labelColor=282828">
<img src="https://img.shields.io/badge/-Redis-DC382D?style=for-the-badge&logo=Redis&logoColor=DC382D&labelColor=282828">
<img src="https://img.shields.io/badge/-ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=E95420&labelColor=282828">
</p>


----------------

### :arrow_down: Installation guide

Enter the following commands in your terminal:

```shell
git clone https://github.com/roozbehrahmani/stadio_challenage
```
```shell
cd stadio_challenage
```
```shell
make up
```
```shell
make setup
```
```shell
make increase_coca
```
```shell
make increase_coffee
```

### :book: List of APIs

You can use the following command to view the list of APIs:

```shell
make route
```

Or use a `postman` file [postman_collection](https://github.com/roozbehrahmani/stadio_challenage/blob/master/Stadio%20Challange.postman_collection.json) is placed in the project to access the APIs.


----------------

### :heavy_check_mark: Other commands

Complete list of commands to use when running the program:

| Command      | Description                                                                |
|--------------|----------------------------------------------------------------------------|
| up      | Create and start containers                                                |
| down    | Stop and remove resources                                                  |
| build   | Build or rebuild services                                                  |
| test    | Run `php artisan test` command on `stadio_challenage` container            |
| setup | Run `php artisan redis:setup` command on `stadio_challenage` container     |
| increase_coca    | Run `product:increase coca 100` command on `stadio_challenage` container   |
| increase_coffee    | Run `product:increase coffee 100` command on `stadio_challenage` container |
| redis   | Go to `redis` container's `bash`                                           |
| env     | Show `.env` file from `stadio_challenage` container                        |
| route   | Show `route list` from `stadio_challenage` container                       |

----------------

### :man_technologist: Author

- [Github](https://github.com/roozbehrahmani)
- [linkedin](https://www.linkedin.com/in/roozbehrahmani)
