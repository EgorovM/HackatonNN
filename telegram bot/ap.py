import requests

fin = open("input.txt")

words = fin.readlines()

for i in range(len(words)):
    if "?" in words[i]:
        print(words[i])
