CHANGING STYLE (.CSS) AND SCRIPTS (.JS) FILES
After changing .css or .js files, GRUNT command must be run:
    - navigate to {project}/trunk
    - run command: sudo grunt

EDITING sphinx.conf file:
Real sphinx.conf file that is used for command "indexer --rotate --all" is stored in /etc/sphinxsearch folder and this file isn't a part of project and isn't tracked by GIT.
Actual copy of real sphinx.conf file stored in the project in {project-folder}/src/configs folder. This copy file is tracked by GIT.