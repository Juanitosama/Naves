# Recurso 1 - Se crean interfaces de red para los diferentes servicios.
resource "azurerm_network_interface" "nic_client" {
  count                                = 2
  name                                 = "nic_client-${count.index + 1}"
  location                             = var.location
  resource_group_name                  = var.name_rg
  ip_configuration {
    name                               = "ipconfig_client-${count.index + 1}"
    subnet_id                          = var.subnet_id
    private_ip_address_allocation      = "Dynamic"
    public_ip_address_id               = var.ip_public_client[count.index]
}
}

resource "azurerm_network_interface" "nic_server" {
  count                                = 2
  name                                 = "nic_server-${count.index + 1}"
  location                             = var.location
  resource_group_name                  = var.name_rg
  ip_configuration {
    name                               = "ipconfig_server-${count.index + 1}"
    subnet_id                          = var.subnet_id
    private_ip_address_allocation      = "Dynamic"
    public_ip_address_id               = var.ip_public_server[count.index]
}
}

resource "azurerm_network_interface" "nic_grafana" {
  count                                = 1
  name                                 = "nic_grafana"
  location                             = var.location
  resource_group_name                  = var.name_rg
  ip_configuration {
    name                               = "ipconfig_grafana"
    subnet_id                          = var.subnet_id
    private_ip_address_allocation      = "Dynamic"
    public_ip_address_id               = var.ip_public_grafana[count.index]
  }
}

# Recurso 2- Se crean las máquinas virtuales con los diferentes servicios.
resource "azurerm_windows_virtual_machine" "client" {
   count                               = 2
   name                                = "vmclient${count.index + 1}"
   resource_group_name                 = var.name_rg
   location                            = var.location
   admin_username                      = "adminuser"
   admin_password                      = "Adminuser123"
   size                                = "Standard_B1ms"
   network_interface_ids               = [azurerm_network_interface.nic_client[count.index].id]
   
   os_disk {
      name                             = "disk_mvclient${count.index + 1}"
      caching                          = "ReadWrite"
      storage_account_type             = "Standard_LRS"
   }

   source_image_reference {
      publisher                        = "microsoftwindowsdesktop"
      offer                            = "windows-10"
      sku                              = "win10-21h2-pro"
      version                          = "latest"
   }
}

resource "azurerm_windows_virtual_machine" "server" {
   count                               = 2
   name                                = "vmserver${count.index + 1}"

   resource_group_name                 = var.name_rg
   location                            = var.location
   admin_username                      = "adminuser"
   admin_password                      = "Adminuser123"
   size                                = "standard_b1ms"
   network_interface_ids               = [azurerm_network_interface.nic_server[count.index].id]
   
   os_disk {
      name                             = "disk_mvserver${count.index + 1}"
      caching                          = "ReadWrite"
      storage_account_type             = "Standard_LRS"
   }

   source_image_reference {
      publisher                        = "microsoftwindowsdesktop"
      offer                            = "windows-10"
      sku                              = "win10-21h2-pro"
      version                          = "latest"
   }
}

resource "azurerm_linux_virtual_machine" "grafana" {
   count                               = 1
   name                                = "grafana"
   resource_group_name                 = var.name_rg
   location                            = var.location
   admin_username                      = "adminuser"
   admin_password                      = "Adminuser123"
   size                                = "standard_b1ms"
   network_interface_ids               = [azurerm_network_interface.nic_grafana[count.index].id]
   disable_password_authentication     = false
   os_disk {
      name                             = "os_disk-grafana"
      caching                          = "ReadWrite"
      storage_account_type             = "Standard_LRS"
   }

   source_image_reference {
      publisher                        = "canonical"
      offer                            = "0001-com-ubuntu-server-focal"
      sku                              = "20_04-lts-gen2"
      version                          = "latest"
   }
}

