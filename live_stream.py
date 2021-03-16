import sys
import os
import random
import moviepy
import time
import moviepy.editor

# But du programme : rechercher une video aléatoirement dans un dossier spécifique

# Dossier dans lesquels effectuer la recherche
mains_folders = ["\zdoc12American Dad\zdoc12American Dad S13",
                 "\zdoc12American Dad\zdoc12American Dad S15",
                 "\zdoc12South Park\zdoc12South Park S16",
                 "\zdoc12South Park\zdoc12South Park S18",
                 "\zdoc12Paradise Police",
                 "\zdoc12Pirates des Caraibes",
                 "\zdoc12Seuls face a l Alaska",
                 "\zdoc12Les Simpson\zdoc12Les Simpson S28",
                 "\zdoc12Les Simpson\zdoc12Les Simpson S04",
                 "\zdoc12Les Simpson\zdoc12Les Simpson S16",

                 "\zdoc12Expendable 1.2.3",
                 "\zdoc12Malcolm\zdoc12S2",
                 "\zdoc12Malcolm\zdoc12S3",
                 "\zdoc12Malcolm\zdoc12S4"
                 ]

# Liste des episodes trouver
eps_folders = []


# Recherche des episodes
for s in mains_folders:
    folders = s;
    dirs = os.listdir( "movie" + folders )

    for f in dirs:
        episode = f;

# Ajout dans la liste
        eps_folders.append("movie" + folders + "\\" + episode)

# Listage de la liste
for file in eps_folders:
   print ( file )

# Choix de l'épisode aléatoirement
print ('Episode tirer :')
rdm_ep = random.choice(eps_folders)
print(rdm_ep)
print(len(eps_folders))


# obtention de la durée de l'épisode
video = moviepy.editor.VideoFileClip(rdm_ep)

def convert(seconds):
    hours = seconds // 3600
    seconds %= 3600
    mins = seconds // 60
    seconds %= 60
    return hours, mins, seconds


video_duration = int(video.duration)
hours, mins, secs = convert(video_duration)
print("Hours:", hours)
print("Minutes:", mins)
print("Seconds:", secs)

total_time = hours * 3600 + mins * 60 + secs
current_time = 0

# Ouverture et écriture dans le fichier
fichier = open("live_player.txt", "w")
fichier.write( rdm_ep + "%" + str(total_time) + "%" + str(current_time) )
fichier.close()


while total_time >= current_time:
    fichier = open("live_player.txt", "r")
    x = fichier.read()
    x = x.split("%")
    fichier.close()

    ep = x[0]
    total_time = x[1]
    current_time = x[2]

    current_time = float(current_time)
    total_time = float(total_time)

    current_time = current_time + 2.01

    # Pause dans le script en Sec
    time.sleep(2)

    print("Episode")
    print(ep)
    print(current_time)
    print(total_time)

    if current_time >= total_time:
        break

    fichier = open("live_player.txt", "w")
    fichier.write( ep + "%" + str(total_time) + "%" + str(current_time) )
    fichier.close()


def restart_program():
    """Restarts the current program.
    Note: this function does not return. Any cleanup action (like
    saving data) must be done before calling this function."""
    python = sys.executable
    os.execl(python, python, * sys.argv)


restart_program()
