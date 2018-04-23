import sys
import ast

weight = sys.argv[1][:-1]
genre = [item.strip() for item in sys.argv[2].split(',')]
dict = ast.literal_eval(weight)

for i in genre:
    if dict[i] == 0:
        dict[i] = 1
    dict[i] *= 1.5

print(str(dict))
