import sys
from random import randint

# print("hello")


weight = {"Action":0, "Adventure":0, "Animation": 0, "Comedy":0, "Crime": 0, "Documentary": 0, "Drama": 0, "Family": 0, "Fantasy": 0, "History": 0, "Horror": 0, "Music": 0, "Mystery": 0, "Romance": 0, "Science Fiction": 0, "TV Movie": 0, "Thriller": 0, "War": 0, "Western": 0}

genres = ["Action", "Adventure", "Animation", "Comedy", "Crime", "Documentary", "Drama", "Family", "Fantasy", "History", "Horror", "Music", "Mystery", "Romance", "Science Fiction", "TV Movie", "Thriller", "War", "Western"]

# print(sys.argv[1])

for genre in genres:
    if genre in sys.argv[1]:
        weight[genre] = randint(3, 5)
    else:
        weight[genre] = randint(0, 2)

print(str(weight))
