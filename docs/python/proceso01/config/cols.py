from openpyxl.cell import column_index_from_string
huecos = {}
huecos['municipio'] = column_index_from_string('G')
huecos['direccion'] = column_index_from_string('I')
huecos['numero']    = column_index_from_string('J')

telefonos = {}           
telefonos['provincia'] = column_index_from_string('E')
telefonos['ciudad']    = column_index_from_string('D')
telefonos['direccion'] = column_index_from_string('B')
telefonos['numero']    = column_index_from_string('A')
telefonos['telefono']  = column_index_from_string('F') 

