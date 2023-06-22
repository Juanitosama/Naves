output "subnet_id" {
  value = azurerm_subnet.subnet.id
}

output "ip_public_client" {
  value = azurerm_public_ip.ip_public_client[*].id
}

output "ip_public_server" {
  value = azurerm_public_ip.ip_public_server[*].id
}

output "ip_public_grafana" {
  value = azurerm_public_ip.ip_public_grafana[*].id
}