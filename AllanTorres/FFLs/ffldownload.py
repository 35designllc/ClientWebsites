import pandas as pd
import os
import glob
import requests


path ="./"

baseUrl = "https://www.atf.gov/firearms/docs/undefined/"

endUrl ="/download"

date = '1123'

middle = '-ffl-list-'

states =['alabama',
         'alaska',
         'arizona',
         'arkansas',
         'california',
         'colorado',
         'connecticut',
         'delaware',
         'florida',
         'georgia',
         'hawaii',
         'idaho',
         'illinois',
         'indiana',
         'iowa',
         'kansas',
         'kentucky',
         'louisiana',
         'maine',
         'maryland',
         'massachusetts',
         'michigan',
         'minnesota',
         'mississippi',
         'missouri',
         'montana',
         'nebraska',
         'nevada',
         'new-hampshire',
         'new-jersey',
         'new-mexico',
         'new-york',
         'north-carolina',
         'north-dakota',
         'ohio',
         'oklahoma',
         'oregon',
         'pennsylvania', 
         'rhode-island',
         'south-carolina',
         'south-dakota',
         'tennessee',
         'texas',
         'utah',
         'vermont',
         'virginia',
         'washington',
         'west-virginia',
         'wisconsin',
         'wyoming']


for state in states:
    fflUrl = baseUrl+date+middle+state+'xlsx'+endUrl
    print(fflUrl)
    resp = requests.get(fflUrl)
    output = open(state+'.xlsx', 'wb')
    output.write(resp.content)
    output.close()



files = glob.glob('./*.xlsx')

dfs=[]

combined_xlsx = pd.DataFrame()



for file in files:
        print(file)
        df = pd.read_excel(file, dtype=str)
        df = df.astype(str)
        dfs.append(df)

combined_xlsx = pd.concat(dfs,ignore_index=True)
combined_xlsx.to_csv('ffls.csv', index = None, header=True, sep=',', encoding='utf-8')

for state in states:
    os.remove(state+'.xlsx')