from openpyxl import Workbook
wb = Workbook()
ws1 = wb.create_sheet()
ws1.title = "New Title"

ws2 = wb["New Title"]
ws3 = wb.get_sheet_by_name("New Title")
print (ws1 is ws2 is ws3)
