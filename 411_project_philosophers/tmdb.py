import tmdbsimple as tmdb
import json
import requests
import MySQLdb

tmdb.API_KEY = 'a6ade97a37d7b3e28fd11f8417ab539c'

def removeNone(elem):
    if elem == None:
        return str(elem)
    else:
        return elem

# schema: Movie(title, release date, director, rating, category, poster, length, summary)
#change the movie to the format of the database
def getMovieInfo(id):
    movie = tmdb.Movies(id)
    movieInfo = movie.info()
    title = movieInfo.get('title')
    release_date = movieInfo.get('release_date')
    language = movieInfo.get('original_language')
    overview = movieInfo.get('overview')
    popularity = movieInfo.get('popularity')
    poster = movieInfo.get('poster_path')
    production_countries = movieInfo.get('production_countries')[0].get('name')
    vote_average = movieInfo.get('vote_average')
    runtime = movieInfo.get('runtime')
    genres = movieInfo.get('genres')
    genrestr = ""
    for elem in genres:
        if genrestr == "":
            genrestr = genrestr + elem.get('name')
        else:
            genrestr = genrestr + ", " + elem.get('name')
    mytuple = tuple(map(lambda x:removeNone(x), [title, release_date, language, overview, popularity, poster, production_countries, vote_average, runtime, genrestr]))
    return mytuple

# def getGenre(id):
#     movie = tmdb.Movies(id)
#     movieInfo = movie.info()
#     genres = movieInfo.get('genres')
#     genrestr = ""
#     for elem in genres:
#         if genrestr == "":
#             genrestr = genrestr + elem.get('name')
#         else:
#             genrestr = genrestr + ", " + elem.get('name')
#     return genrestr

conn = MySQLdb.connect(host = "movietellerdb.web.engr.illinois.edu", user = "movietellerdb_penggu2", passwd = "123456789016gp", db = "movietellerdb_movie")
x = conn.cursor()
numInstance = 0
for i in range(100, 100000):
    if(numInstance > 6666):
        break;
    try:
        values = getMovieInfo(i)
        sql = "INSERT INTO movie(title, release_date, language, overview, popularity, poster, production_country, vote_average, runtime, genres) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s);"
        x.execute(sql, values)
        conn.commit()
        numInstance = numInstance + 1
        print("uploaded one movie!")
    except:
        print("no such movie!")
conn.close()

print("finished!! with movie id" + str(i))
