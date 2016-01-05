import re

patron = re.compile('\+[0-9][0-9]')

print patron.sub('', '+34 945.240.166')
print patron.sub('', '+36 945.240.166')
print patron.sub('', '+37 945.240.166')
