output "virtual_machine_client" {
  value = azurerm_windows_virtual_machine.client[*].id
}

output "vmserver_id" {
  value = azurerm_network_interface.nic_server[*].id
}