<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png"/>
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png"/>
    <script disable-devtool-auto src='//cdn.jsdelivr.net/npm/disable-devtool@latest'></script>
 
    <title>TataPlay - KK Xstream</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 1%;
        background: rgba(14,19,29,0.95);
        color: #fff;
        text-align: center;
    }
    #channelList{
        display: flex;
    flex-wrap: wrap;
    justify-content: center;
    }
/* Basic styles for the card */
.channel {
    text-align: center;
    width: 40%;
    max-width: 150px; /* or any specific width */
    height: ;
    padding: 10px;
    border-radius: 8%;
    position: relative;
    text-align: center;
    margin-bottom: 20px;
    margin: 10px;
    background: rgba(54,69,79,0.6);
}

.channel img {
    margin-top: 0px;
    max-width: 90%;
    padding: 5%;
    object-position: cover;
    object-fit: cover;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
}

.channel-info {
    padding-top: 10px;
    font-weight: bold;
    margin-bottom: 10px;
    border-top: 2px solid #aaa;
}

.channel-info span {
    font-weight: bold;
    text-decoration: none;
    font-size: 13px;
}

.release-date {
    margin-top: 10px;
    margin-bottom: 10px;
    font-weight: bold;
    font-size: 0.85rem;
}

a{
    text-decoration: none;
    color: #fff;
}

#searchInput{
    padding: 10px;
    border-radius: 5px;
    border: 2px solid #777;
    font-family: italic;
    margin-top: 15px;
}
#genreSelect{
    padding: 5px;
    border-radius: 5px;
    border: 2px solid #777;
    font-family: italic;
    max-width: 90px;
    margin-top: 10px;
}
.btn{
    padding: 10px;
    border-radius: 5px;
    border: 2px solid #777;
}
.home{
    margin: 10px 0px;
    border-radius: 5px;
    padding: 10px;
    text-align: center;
    width: 120px;
    background: rgba(54,69,79,0.8);
    color: #fff;
}

        .controls {
            margin-bottom: 10px;
        }
        .controls label, .controls input, .controls select {
            margin-right: 10px;
        }
        .title{
            color: #e11584;
            font-weight: bold;
            padding-top: 20px;
            padding-bottom: 10px;
            margin: -1%;
            width: 102%;
            background: rgba(64,79,89,1);
            z-index: 9999;
            height: 35px;
        }
        .home{
            display: none;
    border-radius: 5px;
    text-align: center;
    width: ;
    margin-left: 0px;
    background: rgba(54,69,79,0.9);
}
    </style>
</head>
<body>
    <div class="title">
        <img style="float: center;" src="https://static.wikia.nocookie.net/logopedia/images/b/b0/Tata_Play_2022.svg" width="">        

    <div class="home">
       <a style="text-decoration: none; color: #fff" href="../">Main Menu</a>
    </div>


        </div>
       
        
    <div class="controls">
        <label for="searchInput"></label>
        <input type="text" id="searchInput" placeholder="🔍 Search channels by name">
      <br>  
      <label for="genreSelect"><span style="font-size: 16px;font-weight: bold;">Genres :</span></label>
        <select id="genreSelect">
            <option value="all">All</option>
        </select>
    </div>
    
    
    <div id="channelList"></div>

    <script>
        let channels = [];

        async function fetchChannels() {
            try {
                const response = await fetch('channels.json');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                channels = await response.json();
                return channels;
            } catch (error) {
                console.error('Error fetching channels:', error);
                return [];
            }
        }

        function displayChannels(filteredChannels) {
            const channelList = document.getElementById('channelList');
            channelList.innerHTML = '';
            if (filteredChannels.length === 0) {
                channelList.innerHTML = '<p>No channels available</p>';
                return;
            }
            filteredChannels.forEach(channel => {
                const channelDiv = document.createElement('div');
                channelDiv.className = 'channel';
                channelDiv.innerHTML = `
                    <a href="play.php?id=${channel.channel_id}"><img src="${channel.channel_logo}" alt="${channel.channel_name}"></a>   <a href="#"> <div class="channel-info">
                    <span>${channel.channel_name}</span></div></a>
                `;
                channelList.appendChild(channelDiv);
            });
        }

        function populateGenreDropdown(channels) {
            const genreSelect = document.getElementById('genreSelect');
            const genres = [...new Set(channels.flatMap(channel => channel.channel_genre))];
            genres.forEach(genre => {
                const option = document.createElement('option');
                option.value = genre;
                option.textContent = genre;
                genreSelect.appendChild(option);
            });
        }

        function filterChannels(channels, genre, searchQuery) {
            return channels.filter(channel => {
                const matchesGenre = genre === 'all' || channel.channel_genre.includes(genre);
                const matchesSearch = channel.channel_name.toLowerCase().includes(searchQuery.toLowerCase());
                return matchesGenre && matchesSearch;
            });
        }

        document.addEventListener('DOMContentLoaded', async () => {
            channels = await fetchChannels();
            populateGenreDropdown(channels);

            const genreSelect = document.getElementById('genreSelect');
            const searchInput = document.getElementById('searchInput');

            const applyFilters = () => {
                const selectedGenre = genreSelect.value;
                const searchQuery = searchInput.value;
                const filteredChannels = filterChannels(channels, selectedGenre, searchQuery);
                displayChannels(filteredChannels);
            };

            genreSelect.addEventListener('change', applyFilters);
            searchInput.addEventListener('input', applyFilters);

            displayChannels(channels);
        });
    </script>

<script disable-devtool-auto='true' src='https://cdn.jsdelivr.net/npm/disable-devtool' clear-log='true' disable-select='true' disable-copy='true' disable-cut='true' disable-paste='true'></script>
<!--END DEVTOOL KILL -->
</html>
