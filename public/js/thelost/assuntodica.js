document.addEventListener("DOMContentLoaded", function() {
    var modalDica = document.getElementById("modal-assunto-dica");
    var closeModalDica = document.getElementById("fechar-modal-assunto-dica");

    var dicasPosts = document.querySelectorAll(".open-modal-dica");
    dicasPosts.forEach(function(post) {
        post.addEventListener("click", function() {
            var dicaId = this.dataset.dicaId;

            // Função para abrir o modal de visualização
            function openViewModal() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var dicaInfo = JSON.parse(xhr.responseText);

                        console.log('Conteúdo de dicaInfo:', dicaInfo);

                        // Atualiza o conteúdo do modal com as informações da dica
                        document.getElementById("imgpostador").src = dicaInfo.foto_postador;
                        document.getElementById("postador-name").textContent = dicaInfo.postador;
                        document.getElementById("titdicas").textContent = dicaInfo.titdicas;
                        document.getElementById("dicascat").textContent = dicaInfo.dicascat;
                        document.getElementById("modal-assunto-dica-content").textContent = dicaInfo.dicasinput;

                        modalDica.style.display = "block";
                    }
                };
                xhr.open("GET", "../view/visu.php?id_dicas=" + dicaId, true);
                xhr.send();
            }

            // Chama a função para abrir o modal de visualização
            openViewModal();

            // Adiciona um ouvinte de eventos ao botão de edição dentro do modal de visualização
            var editButton = document.getElementById('edit-button');
            editButton.addEventListener('click', function () {
                // Chama a função para abrir o modal de edição
                openEditModal(dicaId);
            });
        });
    });

    // Função para fechar o modal
    function fecharModal() {
        modalDica.style.display = "none";
    }

    // Fecha o modal ao clicar no botão de fechar
    closeModalDica.addEventListener("click", fecharModal);

    // Função para abrir o modal de edição
    function openEditModal(dicaId) {
        var editModal = document.getElementById('myModal');

        fetch("../view/visu.php?id_dicas=" + dicaId)
            .then(response => response.json())
            .then(dadosDaDica => {

                document.getElementById('titdicass').value = dadosDaDica.titdicas;
                document.getElementById('dicascats').value = dadosDaDica.dicascat;
                document.getElementById('dicasinput').value = dadosDaDica.dicasinput;

                editModal.style.display = 'block';
            })
            .catch(error => {
                console.error('Erro ao obter dados da dica:', error);
            });
    }

    // Função para fechar o modal de edição
    function closeModal() {
        var editModal = document.getElementById('myModal');
        editModal.style.display = 'none';
    }
});
