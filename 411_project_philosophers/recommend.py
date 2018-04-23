import numpy as np
import sys
import ast
import json
import pymysql
import operator

value = sys.argv[1][:-1]
dict = ast.literal_eval(value)
theta = np.array(list(dict.values()))

try:
    conn = pymysql.connect(host = "movietellerdb.web.engr.illinois.edu",
                       user = "movietellerdb_penggu2",
                       passwd = "123456789016gp",
                       db = "movietellerdb_movie")
except Exception as e:
    print("connection failed")

cursor = conn.cursor()

sql = "SELECT weight, ID FROM movie WHERE popularity > 10 ORDER BY vote_average DESC"
cursor.execute(sql)
data = cursor.fetchall()

score = {}
for i in range(100):
    ID = data[i][1]
    movie_dict = ast.literal_eval(data[i][0])
    x = np.array(list(movie_dict.values()))
    score[ID] = np.dot(theta, x.T)

ID = [item[0] for item in sorted(score.items(), key=operator.itemgetter(1), reverse=True)[:10]]
print("".join(str(ID)[1:-1].split()))
