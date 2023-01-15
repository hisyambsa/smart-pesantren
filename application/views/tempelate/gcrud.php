<style>
    .gc-select-row {
        position: absolute;
    }

    .leaderboard-strava {
        min-height: 100vh !important;
    }

    .alert-costum {
        color: #fefefe;
        background-color: #007170;
    }
</style>

<div class="leaderboard-strava">
    <div class="mx-5 mb-2">
        <div class="alert alert-costum h4-responsive" role="alert">
            <?= $subject ?>
        </div>
        <?= $dataGcrud ?>
    </div>
</div>

<script>
    window.addEventListener('gcrud.datagrid.ready', () => {
        $('.filter-row').hide();
        $('.column-with-ordering').removeClass();
    });
</script>