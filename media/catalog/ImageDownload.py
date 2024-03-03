import csv
import os
import requests
from PIL import Image

path ="./"

baseUrl = "https://www.lipseyscloud.com/images/"

with open('../../lipseysCatalogs/LipseyCatalog.csv', newline='') as itemCatalog:
        reader = csv.DictReader(itemCatalog)
        for row in reader:
            if row['IMAGENAME']:
                imgname = row['IMAGENAME'].split(".")
                if len(imgname) > 1: 
                    imagePath = path + imgname[0]+'.webp'
                    if os.path.exists(imagePath):
                        print("Skipping:", row['IMAGENAME'], "already exists!")
                    else:                        
                        imgUrl = baseUrl + str(row['IMAGENAME'])
                        response = requests.get(imgUrl, stream=True)
                        if response.status_code == 200:
                            img = Image.open(requests.get(imgUrl, stream = True).raw)
                            w, h = img.size
                            if w > 16383 or h > 16383:
                                img = img.resize((w//2, h//2))

                            print("Adding:", row['IMAGENAME'], "as", imgname[0]+'.webp')
                            img.save(imgname[0]+'.webp', optimize=True, quality=60)
