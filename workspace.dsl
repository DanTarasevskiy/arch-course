workspace {
    name "Пример"
    model {
        myUser   =  person "Пользователь"
        mySystem =  softwareSystem "Моя система"
        otherSystem =  softwareSystem "Чужая система"
        myUser   -> mySystem "Работает в системе"
        mySystem -> otherSystem "Запрашивает полезные данные" "HTTP\443"
    }
    views {
        systemContext  mySystem {
            include *
            autoLayout
        }
        themes default
    }
}