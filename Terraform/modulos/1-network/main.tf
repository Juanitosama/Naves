# Recurso 1 - Se crea una vnet.
resource "azurerm_virtual_network" "vnet" {
  name                               = "vnet"
  address_space                      = [var.address_space]
  location                           = var.location
  resource_group_name                = var.name_rg
}

# Recurso 2- Se crea una subnet.
resource "azurerm_subnet" "subnet" {
  name                               = "subnet"
  resource_group_name                = var.name_rg
  virtual_network_name               = azurerm_virtual_network.vnet.name
  address_prefixes                   = [var.address_prefixes]
}

# Recurso 3 - Se crean direcciones IP públicas para los diferentes servicios.
resource "azurerm_public_ip" "ip_public_client" {
  count                              = 2
  name                               = "ip_public_client-${count.index+ 1}"
  location                           = var.location
  resource_group_name                = var.name_rg
  allocation_method                  = "Static"
}

resource "azurerm_public_ip" "ip_public_server" {
  count                              = 2
  name                               = "ip_public_server-${count.index + 1}"
  location                           = var.location
  resource_group_name                = var.name_rg
  allocation_method                  = "Static"
}

resource "azurerm_public_ip" "ip_public_grafana" {
  count                              = 1
  name                               = "ip_public_grafana"
  location                           = var.location
  resource_group_name                = var.name_rg
  allocation_method                  = "Static"
}

