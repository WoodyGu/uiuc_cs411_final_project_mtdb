from DataReport import EvaluationByTime
import numpy as np
import pymysql
import sys

## ADD Production Country (Bar)
## Country with popularity
##
CATEGORY = ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Romance", "Science Fiction", "TV Movie", "Thriller", "War", "Western"]
# COLOR = []
##############################INPUT MESSAGE###################################
diag = sys.argv[1] #bar, pie, plot
tot_bo = sys.argv[2]
gener_hist = sys.argv[3]
cate_intg = sys.argv[4]
##############################INPUT MESSAGE###################################
conn = pymysql.connect(host = "movietellerdb.web.engr.illinois.edu",
                       user = "movietellerdb_penggu2",
                       passwd = "123456789016gp",
                       db = "movietellerdb_movie")

cursor = conn.cursor()
'''
    sql: get the y_values from the database
    sql1: get the x_ticks from the database
'''

'''
diag: plot/pie
generation: all or num(70,80,90,00,10)
tot_bo: total or box_office
cate_intg: all or cate (when pie, only all)
'''

if diag == "plot":
    if tot_bo == "quantity":
        if gener_hist == "all":
            if cate_intg == "all": ##Done
                sql = "SELECT YEAR(release_date), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE YEAR(release_date)>1800 " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
            else: ##Done
                sql = "SELECT YEAR(release_date), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE genres LIKE \'%" + cate_intg + "%\' " + \
                      "AND YEAR(release_date)>1800 " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
        else: ## require a certain generation
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            if cate_intg == "all": ## TODO: TEST
                sql = "SELECT YEAR(release_date), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
            else: ## Done
                sql = "SELECT YEAR(release_date), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "AND genres LIKE \'%" + cate_intg + "%\' " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
    elif tot_bo == "box office":
        if gener_hist == "all":
            if cate_intg == "all": ## Done
                sql = "SELECT YEAR(release_date), SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE YEAR(release_date)>1800 " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
            else: ## Done
                sql = "SELECT YEAR(release_date), SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE genres LIKE \'%" + cate_intg + "%\' " + \
                      "AND YEAR(release_date)>1800 " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
        else: ## require a certain generation
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            if cate_intg == "all": ## Done
                sql = "SELECT \'" + str(year) + "\', SUM(revenue)  " + \
                      "FROM movie " + \
                      "WHERE YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "GROUP BY YEAR(release_date) " + \
                      "ORDER BY YEAR(release_date)"
            else: ## Done
                sql = "SELECT \'" + str(year) + "\', SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "AND genres LIKE \'%" + cate_intg + "%\' " + \
                      "GROUP BY YEAR(release_date) "

elif diag == "pie":
    sql = []
    if tot_bo == "quantity": ## Done
        if gener_hist == "all":
            for genre in CATEGORY:
                s = "SELECT \'" + genre + "\', COUNT(*) " + \
                    "FROM movie " + \
                    "WHERE genres LIKE \'%" + genre + "%\'"
                sql.append(s)
        else: ## Done
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            for genre in CATEGORY:
                s = "SELECT \'" + genre + "\', COUNT(*) " + \
                    "FROM movie " + \
                    "WHERE genres LIKE \'%" + genre + "%\' AND " + \
                    "YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year)
                sql.append(s)
    elif tot_bo == "box office": ## Done
        if gener_hist == "all":
            for genre in CATEGORY:
                s = "SELECT \'" + genre + "\', SUM(revenue) " + \
                    "FROM movie " + \
                    "WHERE genres LIKE \'%" + genre + "%\'"
                sql.append(s)
        else: ## Done
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            for genre in CATEGORY:
                s = "SELECT \'" + genre + "\', SUM(revenue) " + \
                    "FROM movie " + \
                    "WHERE genres LIKE \'%" + genre + "%\' AND " + \
                    "YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year)
                sql.append(s)



elif diag == "bar":
    ## x-axis are countries, y axis is total/box_office/popularity
    if tot_bo == "quantity":
        if gener_hist == "all":
            if cate_intg == "all": ## Done
                sql = "SELECT production_country, COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "GROUP BY production_country"
            else: ## Done
                sql = "SELECT production_country, COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND genres LIKE \'%" + cate_intg + "%\'" + \
                      "GROUP BY production_country"
        else:
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            if cate_intg == "all": ## Done
                sql = "SELECT production_country, COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "GROUP BY production_country"
            else:
                sql = "SELECT production_country, COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "AND genres LIKE \'%" + cate_intg + "%\'" + \
                      "GROUP BY production_country"
    elif tot_bo == "box office":
        if gener_hist == "all":
            if cate_intg == "all":
                sql = "SELECT production_country, SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "GROUP BY production_country " + \
                      "HAVING SUM(revenue)<>0"
            else:
                sql = "SELECT production_country, SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND genres LIKE \'%" + cate_intg + "%\'" + \
                      "GROUP BY production_country " + \
                      "HAVING SUM(revenue)<>0"
        else:
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            if cate_intg == "all":
                sql = "SELECT production_country, SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "GROUP BY production_country " + \
                      "HAVING SUM(revenue)<>0"
            else:
                sql = "SELECT production_country, SUM(revenue) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "AND genres LIKE \'%" + cate_intg + "%\'" + \
                      "GROUP BY production_country " + \
                      "HAVING SUM(revenue)<>0"
    elif tot_bo == "popularity":
        if gener_hist == "all":
            if cate_intg == "all":
                sql = "SELECT production_country, SUM(popularity), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND popularity IS NOT null " + \
                      "AND popularity <> 0 " + \
                      "GROUP BY production_country"
            else:
                sql = "SELECT production_country, SUM(popularity), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND popularity IS NOT null " + \
                      "AND popularity <> 0 " + \
                      "AND genres LIKE \'%" + cate_intg + "%\'" + \
                      "GROUP BY production_country"
        else:
            gen = int(gener_hist)
            if gen <= 10:
                year = 2000 + gen
            else:
                year = 1900 + gen
            if cate_intg == "all":
                sql = "SELECT production_country, SUM(popularity), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND popularity IS NOT null " + \
                      "AND popularity <> 0 " + \
                      "AND YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "GROUP BY production_country"
            else:
                sql = "SELECT production_country, SUM(popularity), COUNT(*) " + \
                      "FROM movie " + \
                      "WHERE production_country IS NOT null " + \
                      "AND popularity IS NOT null " + \
                      "AND popularity <> 0 " + \
                      "AND genres LIKE \'%" + cate_intg + "%\'" + \
                      "AND YEAR(release_date)>="+str(year)+" AND YEAR(release_date)<="+str(year+9) + " " + \
                      "GROUP BY production_country"
else:
    print("Something wrong with SQL!!!")
# ##############################SET PARAMETERS###################################
y_values = [] #list
y_ticks = []
y_label = tot_bo

x_values = []
x_label = "Generation"
if diag == "pie":
    x_label = "Country"
if gener_hist == "all":
    x_label = "year"
x_ticks = []

explode = []
title = {"y_label": y_label.title(),
         "x_label": x_label.title(),
         "from_year": "1889",
         "to_year": "2020",
         "cate_intg": cate_intg.title()}
if gener_hist != "all":
    title["from_year"] = year
    title["to_year"] = year + 9

if diag == "plot":
    try:
        cursor.execute(sql)
        y = cursor.fetchall()
        y_values = [int(x[1]) for x in y]
        x_values = np.arange(0, len(y_values), 1)
        x_ticks = [x[0] for x in y]
        title["to_year"] = x_ticks[-1]
    except:
       print("diag_SQL_Error: unable to fecth data")
elif diag == "pie":
    try:
        temp = []
        for s in sql:
            # print("sql:{}".format(s))
            # print("pie reach 1")
            cursor.execute(s)
            # print("pie reach 2")
            y = cursor.fetchall()
            # print("sql_fetchall:{}".format(y))
            temp.append(y[0])
        # print("y_values:{}".format(temp))
        temp = sorted(temp, key=lambda x: x[1])
        for item in temp:
            y_values.append(item[1])
            y_ticks.append(item[0])
        # print("sorted_y_values:{}".format(y_values))
        # print("y_ticks:{}".format(y_ticks))
        # title = gener_hist
        # y_label = tot_bo
        if cate_intg != "all":
            for tick in y_ticks:
                if tick != cate_intg:
                    explode.append(0)
                else:
                    explode.append(0.05)
    except:
        print("pie_SQL_Error: unable to fecth data")
elif diag == "bar":
    try:
        x_label = "Country"
        # print("sql:{}".format(sql))
        # print("plot reach 1")
        cursor.execute(sql)
        y = cursor.fetchall()
        # print("plot reach 2")
        # print("y:{}".format(y))
        temp_list = []
        if tot_bo == "popularity":
            for item in y:
                temp = (item[0], round(float(item[1]) / float(item[2]), 4), item[2])
                temp_list.append(temp)
            y = temp_list
        # print("processed_y:{}".format(y))
        y = sorted(y, key=lambda x: x[1])
        # print("sorted_y:{}".format(y))
        if tot_bo == "popularity":
            y_values = [x[1] for x in y]
        else:
            y_values = [int(x[1]) for x in y]
        # print("y_values:{}".format(y_values))
        x_values = np.arange(0, len(y_values), 1)
        x_ticks = [x[0] for x in y]
        # print("x_values:{}".format(x_values))
    except:
        print("bar_SQL_Error: unable to fecth data")
else:
    print("SQL Execution Diag Error")


conn.close()

 #################################################################################################################################################
# diag = "pie"
# y_ticks = ['Frogs', 'Hogs', 'Dogs', 'Logs']
# y_values = [15, 30, 45, 10]
#
# model = EvaluationByTime(diag=diag, y_values=y_values, y_ticks=y_ticks)
# model.create_graph()
#################################################################

model = EvaluationByTime(diag=diag, y_values=y_values, y_ticks=y_ticks, y_label=y_label, x_values=x_values, x_ticks=x_ticks, x_label=x_label, title=title, explode=explode)

model.create_graph()
