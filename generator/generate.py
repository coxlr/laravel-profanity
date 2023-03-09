# -*- coding: utf-8 -*-
import json, glob

files = glob.glob("./dictionaries/*")

dictionary = []
wc = 0
output_file = '../src/Dictionary/Profanity.json'
for file in files:
    if file != __file__:
        f = open(file, 'r', encoding="utf8")
        print("Generating from language file: " + str(file))
        for line in f:
            d = {'language': file.replace("./dictionaries/", ""), 'word': line.rstrip()}
            dictionary.append(d)
            wc += 1

output = open(output_file, 'w')
output.write(json.dumps(dictionary, indent=4, sort_keys=True))
print("Done... " + str(wc) + " profanity words added to " + str(output_file))
