module "network" {
  source                  = "../modulos/1-network"

  # Recurso 1
  location                = var.location
  name_rg                 = var.name_rg
  address_space           = var.address_space
  
  # Recurso 2
  address_prefixes        = var.address_prefixes
}

module "vm" {
   source                 ="../modulos/2-vm"

   # Recurso 1
   location               = var.location
   name_rg                = var.name_rg   
   subnet_id              = module.network.subnet_id
   ip_public_client       = module.network.ip_public_client
   ip_public_server       = module.network.ip_public_server
   ip_public_grafana      = module.network.ip_public_grafana
}

module "lb" {
  
  source                  = "../modulos/3-lb"

  # Recurso 1
  location                = var.location
  name_rg                 = var.name_rg   
  subnet_id               = module.network.subnet_id
  vmserver-nic_id         = module.vm.vmserver_id
}

module "storage" {
  source                  = "../modulos/4-storage"

   # Recurso 1
   location               = var.location
   name_rg                = var.name_rg 
   virtual_machine_client = module.vm.virtual_machine_client
}

