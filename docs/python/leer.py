from openpyxl import load_workbook
wb = load_workbook('tmp/leer.xlsx') 
ws = wb.active

print '';
print '';
print '';
print '';
print '';
print '';
print '';

i  = 8685
for row in ws.rows:
    for cell in row:
        v = cell.value.replace("'", "\\'")
	v = v.strip()
	# id, nombre, nivel, tipo_id, parent_id 
        s = u"(%s, '%s', 4, 5, 34)," %(i, v)
        print s
        i+=1
