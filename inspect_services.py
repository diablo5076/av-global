import glob, os, re

services = ['casting-moulding.php', 'turning-shaping.php', 'hand-engraving-nakkashi.php', 'polishing-buffing.php', 'hand-painted-meenakari.php', 'electroplating-finishing.php']
for s in services:
    if os.path.exists(s):
        with open(s, 'r', encoding='utf-8', errors='ignore') as fp:
            c = fp.read()
        imgs = re.findall(r'assets/img/[^\s"\'\)]+', c)
        print(s, '->', imgs[:4])
