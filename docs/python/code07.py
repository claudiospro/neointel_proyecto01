from openpyxl import Workbook
wb = Workbook()
ws1 = wb.active
ws1.title= 'Mi Hoja 01'
ws2 = wb.create_sheet()

print (wb.get_sheet_names())
