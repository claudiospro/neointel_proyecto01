from openpyxl import Workbook
wb = Workbook()
ws = wb.create_sheet()
ws.title = "New Title"
ws.sheet_properties.tabColor = "1072BA"
