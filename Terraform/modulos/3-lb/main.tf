#Recurso 1 - Crea Load Balancer para distribuir tráfico sobre los servidores
resource "azurerm_lb" "lb" {
   name                                = "loadbalancer"
   location                            = var.location
   resource_group_name                 = var.name_rg

# Configura el Frontend del Load balancer con su dirección IP.
frontend_ip_configuration {
   name                                = "frontend"
   public_ip_address_id                = var.subnet_id
   }
}


# Crea backend de soporte al Load Balancer y que contendrá las máquinas virtuales
resource "azurerm_lb_backend_address_pool" "backend" {
   loadbalancer_id                     = azurerm_lb.lb.id
   name                                = "backend"
}

# Asocia el pool a los servidores a traves de su interfaz de red.
resource "azurerm_network_interface_backend_address_pool_association" "backend_association" {
   count                               = 2
   ip_configuration_name               = "nic-conf"
   network_interface_id                = var.vmserver-nic_id[count.index]
   backend_address_pool_id             = azurerm_lb_backend_address_pool.backend.id
}

# Crea regla en el Load Balancer para dirigir tráfico HTTP al backend.
resource "azurerm_lb_rule" "rule80" {
   loadbalancer_id                     = azurerm_lb.lb.id
   name                                = "HTTPRule"
   protocol                            = "Tcp"
   frontend_port                       = 80
   backend_port                        = 80
   frontend_ip_configuration_name      = "frontend"
   backend_address_pool_ids            = [azurerm_lb_backend_address_pool.backend.id]
}

resource "azurerm_lb_rule" "rule3306" {
   loadbalancer_id                     = azurerm_lb.lb.id
   name                                = "HTTPRule"
   protocol                            = "Tcp"
   frontend_port                       = 3306
   backend_port                        = 3306
   frontend_ip_configuration_name      = "frontend"
   backend_address_pool_ids            = [azurerm_lb_backend_address_pool.backend.id]
}