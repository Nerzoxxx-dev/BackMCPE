# EN
# BackMCPE

## How to config

To config this plugin, you must know how to locate the config file of BackMCPE, it is often located in ``your_server_directory/plugin_data/BackMCPE/config.yml``. Once found, you must open this. This file should look like this: 
```yml
driver: "SQLite3" #Possible choices: YAML, MySQL, SQLite3. If the driver was changed, all old datas used by the old driver can't be used for the new driver
mysql_host: "" #Can be null if the driver selected was YAML or SQLite3
mysql_user: "" #Can be null if the driver selected was YAML or SQLite3
mysql_password: "" #Can be null if the driver selected was YAML or SQLite3
mysql_database: "" #Can be null if the driver selected was YAML or SQLite3
plugin_enabled: "§2 ON"
plugin_disabled: "§c OFF"

prefix: "§e[Back]" #The prefix of the command. This is used to have a message like this: `` §e [Back] MESSAGE``
command.description: #Use this to teleport you at your kill position" #The description command
command.usage_message: "§c /back" #The usage message of the description
command.aliases:  #The aliases of the command.
  - "b"
command.permission: "back.use" #The permission to use this command

use_in_game: "{prefix} §cPlease use this command in game."  #The message when the sender of the command isn't a player
player_doesnt_have_permission: "{prefix} §cYou don't have the permission to use this command." #When the player haven't the permission to use this command
player_doesnt_have_coordinates_set: "{prefix} §cYou don't have coordinates set." #When the player haven't coordinates set to teleport him
player_teleport: "{prefix} §2You're teleport to your deaths coordinates." #When the player is succesfully teleported

delete_coordinates_after_use: "true" #Change to false if you don't want the player's coordinates are delete after he use this command
delete_coordinates_after_left: "true" #Change to false if you don't want the player's coordinates are delete after he use left the server
```

The ``driver`` field correspond to the type of driver you want to use for data management. This is basic set on JSON. If you don't know what's the driver, let this field on JSON. There are 3 drivers currently: JSON, SQLite3 and MySQL.
The fields who starts with mysql can be null if the driver selected wasn't MySQL.

To contact me, here is my [discord](https://discord.com): Nerzoxxx#0001

# FR

# BackMCPE

## Comment configurer

Pour configurer ce plugin, vous devez savoir localiser le fichier de configuration de BackMCPE, il se trouve souvent dans `` votre_répertoire_serveur / plugin_data / BackMCPE / config.yml``. Une fois trouvé, vous devez l'ouvrir. Ce fichier devrait ressembler à ceci :

```yml
driver: "SQLite3" #Possible choices: YAML, MySQL, SQLite3. If the driver was changed, all old datas used by the old driver can't be used for the new driver
mysql_host: "" #Can be null if the driver selected was YAML or SQLite3
mysql_user: "" #Can be null if the driver selected was YAML or SQLite3
mysql_password: "" #Can be null if the driver selected was YAML or SQLite3
mysql_database: "" #Can be null if the driver selected was YAML or SQLite3
plugin_enabled: "§2 ON"
plugin_disabled: "§c OFF"

prefix: "§e[Back]" #The prefix of the command. This is used to have a message like this: `` §e [Back] MESSAGE``
command.description: #Use this to teleport you at your kill position" #The description command
command.usage_message: "§c /back" #The usage message of the description
command.aliases:  #The aliases of the command.
  - "b"
command.permission: "back.use" #The permission to use this command

use_in_game: "{prefix} §cPlease use this command in game."  #The message when the sender of the command isn't a player
player_doesnt_have_permission: "{prefix} §cYou don't have the permission to use this command." #When the player haven't the permission to use this command
player_doesnt_have_coordinates_set: "{prefix} §cYou don't have coordinates set." #When the player haven't coordinates set to teleport him
player_teleport: "{prefix} §2You're teleport to your deaths coordinates." #When the player is succesfully teleported

delete_coordinates_after_use: "true" #Change to false if you don't want the player's coordinates are delete after he use this command
delete_coordinates_after_left: "true" #Change to false if you don't want the player's coordinates are delete after he use left the server
```

Le champ `` driver`` correspond au type de driver que vous souhaitez utiliser pour la gestion des données. Il est de base mis sur JSON. Si vous ne savez pas quel est le pilote, laissez ce champ sur JSON. Il existe actuellement 3 pilotes : JSON, SQLite3 et MySQL.
Les champs qui commencent par mysql peuvent être nuls si le pilote sélectionné n'était pas MySQL.

Pour me contacter, voici mon [discord](https://discord.com) : Nerzoxxx #0001
