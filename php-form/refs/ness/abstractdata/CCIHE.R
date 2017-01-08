
library(magrittr)
library(dplyr)

library(readr)

indata <-
    read_tsv("CCIHE2015.csv") %>%
    filter(OBEREG %in% c(1, 2)) %>%  ## Only New England, Mid East
    use_series(NAME) %>%
    paste0(collapse = "\n")

write(indata, file = "schools.txt")

