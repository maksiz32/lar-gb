<footer class="row justify-content-center fixed-bottom my-footer">
    @php
        $start_Year = "2021";
        $this_Year = date('Y');
        if ($start_Year == $this_Year) {
            $years = $start_Year;
        } else {
            $years = "{$start_Year} - {$this_Year}";
        }
    @endphp
    {{ $years }}
</footer>
