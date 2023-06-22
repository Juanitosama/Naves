#Recurso 1 - Se crean unos discos de datos.
 resource "azurerm_managed_disk" "data_disk" {
  count                = 2
  name                 = "datadisk-${count.index + 1}"
  location             = var.location
  resource_group_name  = var.name_rg
  storage_account_type = "Standard_LRS"
  create_option        = "Empty"
  disk_size_gb         = 512
 }

#Recurso 2 - Se asignan los discos de datos a los equipos cliente.
resource "azurerm_virtual_machine_data_disk_attachment" "data_disk_attachment" {
  count                = 2
  managed_disk_id      = azurerm_managed_disk.data_disk[count.index].id
  virtual_machine_id   = var.virtual_machine_client[count.index]
  lun                  = 1
  caching              = "ReadWrite"
}