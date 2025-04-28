document.addEventListener('DOMContentLoaded', apiPessoas())



async function apiPessoas() {

    const pessoas = await fetch("http://127.0.0.1:8000/api/user")
        .then(response => {
            if (!response.ok) {
                throw new Error("Erro ao consultar o CEP")
            }
            return response.json()
        })
        .then(data => {


            /////////
            let arrayUsers;
            arrayUsers = data.users

            document.getElementById('inputUser').addEventListener('input', function () {
                document.getElementById('userTable').innerHTML = ""
                let input = document.getElementById('inputUser').value
                
                for (let i = 0; i < arrayUsers.length; i++) {
                    let userName = `${arrayUsers[i].name}`
                    
                    if (userName.trim().toLocaleLowerCase().includes(input.trim().toLocaleLowerCase())) {


                        let id = arrayUsers[i].id
                        let firstName = arrayUsers[i].name
                        let email = arrayUsers[i].email

                        let userTable = document.getElementById('userTable')
                        let tr = document.createElement('tr')

                        let th = document.createElement('th')
                        th.scope = 'row'
                        th.classList.add('text-center')
                        th.innerHTML = id

                        let tdName = document.createElement('td')
                        tdName.classList.add('text-center', 'fw-lighter')
                        tdName.innerHTML = `${firstName}`
                        let tdEmail = document.createElement('td')
                        tdEmail.classList.add('text-center', 'fw-lighter')
                        tdEmail.innerHTML = email

                        tr.appendChild(th)
                        tr.appendChild(tdName)
                        tr.appendChild(tdEmail)

                        userTable.appendChild(tr)

                    }

                }


            })
            /////////


            data.users.forEach(element => {

                let id = element.id
                let firstName = element.name
                let email = element.email

                let userTable = document.getElementById('userTable')
                let tr = document.createElement('tr')

                let th = document.createElement('th')
                th.scope = 'row'
                th.classList.add('text-center')
                th.innerHTML = id

                let tdName = document.createElement('td')
                tdName.classList.add('text-center', 'fw-lighter')
                tdName.innerHTML = `${firstName}`

                let tdEmail = document.createElement('td')
                tdEmail.classList.add('text-center', 'fw-lighter')
                tdEmail.innerHTML = email
              

                tr.appendChild(th)
                tr.appendChild(tdName)
                tr.appendChild(tdEmail)
               

                userTable.appendChild(tr)


            });

        })



}

function recarregar() {
    location.reload();
}

