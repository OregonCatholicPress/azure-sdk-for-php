## Description


### Checklist:
1. [ ] Tests added covering new use cases?
2. [ ] Successfully ran tests with your changes locally?
3. [ ] Tested with Azure?
4. [ ] Does this code have change in common that will existing functionality?
5. [ ] Double-checked that no secrets are posted in the PR?


## Steps to Test
```sh
> git clone https://github.com/OregonCatholicPress/azure-sdk-for-php
> cd azure-sdk-for-php
> git pull
> git checkout <feature_branch>
> php composer install
> vendor/bin/phpunit
```
