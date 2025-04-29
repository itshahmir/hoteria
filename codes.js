function error(msg) {
    document.getElementById("error").innerHTML = msg;
}

function warn(msg) {
    document.getElementById("warn").innerHTML = msg;
}

function setLetterCase(characters) {
    var refined = "";
    var comma = characters.split(',');
    for (var c = 0; c < comma.length; c++) {
        var space = comma[c].split(' ');
        if (space[0].length > 0) {
            for (var s = 0; s < space.length; s++) refined += " " + space[s].charAt(0).toUpperCase() + space[s].substring(1).toLowerCase();
            refined += ",";
        }
    }
    return refined;
}
function clear()
{
    error("");
    warn("");
    document.getElementById("Gender").innerHTML = "Gender: ";
    document.getElementById("Location").innerHTML = "Residence: ";
}
function trackLocation() {
    clear();
    var cnic = document.getElementById("cnc");
    var val = cnic.value.trim();
    if (val.length != 15) {
        warn("Example: 12345-6789012-3");
        return error("CNIC should be 15 digit long including dashes");
    }
    var Location = document.getElementById("Location");
    Location.value = setLetterCase(locate(val));
}

    
    
function gender(cnic) {
    return (cnic.slice(-1) % 2 == 0 ? "Female" : "Male"); // female vs male = even vs odd
}

function locate(cnic) {
    //var location = "Residence: "
    var location = ""
    var Province = cnic.charAt(0)
    var Division = cnic.charAt(1)
    var District = cnic.charAt(2)
    var Tehsil = cnic.charAt(3)
    var Counsil = cnic.charAt(4)

    if (Province == 1) {
        location += "KHYBER PAKHTUNKHWA,"
        if (Division == 1) {
            location += "BANNU,"
            if (District == 1) {
                location += "BANNU,"
               
            } else if (District == 2) {
                location += "BANNU CANTONMENT,"
                
            }
        } else if (Division == 2) {
            location += "DERA ISMAIL KHAN,"
            if (District == 1) {
                location += "DERA ISMAIL KHAN,"
               
               
            } else if (District == 2) {
                location += "TAANK,"
               
            }
        } else if (Division == 3) {
            location += "HAZARA,"
            if (District == 1) {
                location += "ABBOTTABAD,"
                
            } else if (District == 2) {
                location += "BATAGRAM,"
                
            } else if (District == 3) {
                location += "HARIPUR,"
               
            } else if (District == 4) {
                location += "KOHISTAN,"
                
            } else if (District == 5) {
                location += "MANSEHRA,"
               
            }
        } else if (Division == 4) {
            location += "KOHAT,"
            if (District == 1) {
                if (Tehsil == 0) {
                    location += "HANGU,"
                }
            } else if (District == 2) {
                if (Tehsil == 0) {
                    location += "KARAK,"
                  
                }
            } else if (District == 3) {
                if (Tehsil == 0) {
                    location += "KOHAT,"
                    
                }
            }
        } else if (Division == 5) {
            location += "MALAKAND,"
            if (District == 0) location += "DEER,"
            else if (District == 1) {
                location += "BUNER,"
              
            } else if (District == 2) {
                location += "LOWER CHITRAL,"
                
            } else if (District == 3) {
                location += "LOWER DEER,"
                
            } else if (District == 4) {
                location += "MALAKAND,"
                
            } else if (District == 5) {
                location += "SHANGLA,"
                
            } else if (District == 6) {
                location += "SWAT,"
                
            } else if (District == 7) {
                location += "UPPER DIR,"
               
            }
        } else if (Division == 6) {
            location += "MARDAN,"
            if (District == 1) {
                location += "MARDAN,"
                
            } else if (District == 2) {
                location += "SWABI,"
                
            }
        } else if (Division == 7) {
            location += "PESHAWAR,"
            if (District == 1) {
                location += "CHARSADDA,"
                
            } else if (District == 2) {
                location += "NOWSHERA,"
                
            } else if (District == 3) {
                location += "PESHAWAR,"
                
            }
        }
    } else if (Province == 2) {
        location += "FATA,"
        if (Division == 1) {
            location += "AGENCY,"
            if (District == 1) {
                location += "BAJOUR,"
               
            } else if (District == 2) {
                location += "KHYBER,"
                
            } else if (District == 3) {
                location += "KARAM,"
               
            } else if (District == 4) {
                location += "MEHMAND,"
        
            } else if (District == 5) {
                location += "NARTH WAZIRISTAN,"
                
            } else if (District == 6) {
                location += "ORAKZAI,"
                
            } else if (District == 7) {
                location += "SOUTH WAZIRISTAN,"
               
            }
        } else if (Division == 2) {
            location += "QABAILI ILAQA,"
            if (District == 1) {
                location += "LUCKY MARWAT,"
                
            } else if (District == 2) {
                location += "BANNU,"
               
            } else if (District == 3) {
                location += "DERA ISMAIL KHAN,"
                
            } else if (District == 4) {
                location += "KOHAT,"
               
            } else if (District == 5) {
                location += "PESHAWER,"
                
            } else if (District == 6) {
                location += "TANK,"
               
            }
        }
    } else if (Province == 3) {
        location += "PUNJAB,"
        if (Division == 1) {
            location += "BAHAWALPUR,"
            if (District == 1) {
                location += "BAHAWALNAGAR,"
               
            } else if (District == 2) {
                location += "BAHAWALPUR,"
                
            } else if (District == 3) {
                location += "RAHIM YAAR KHAN,"
                
            }
        } else if (Division == 2) {
            location += "DERA GHAZI KHAN,"
            if (District == 1) {
                location += "DERA GHAZI KHAN,"
                
            } else if (District == 2) {
                location += "LAYYAH,"
                
            } else if (District == 3) {
                location += "MUZAFFARGARH,"
               
            } else if (District == 4) {
                location += "RAJANPUR,"
              
            }
        } else if (Division == 3) {
            location += "FAISALABAD,"
            if (District == 1) {
                location += "FAISALABAD,"
               
            } else if (District == 2) {
                location += "JHANG,"
                
            } else if (District == 3) {
                location += "TOBA TEK SINGH,"
              
            } else if (District == 4) {
                location += "CHINIOT,"
              
            }
        } else if (Division == 4) {
            location += "GUJRANWALA,"
            if (District == 1) {
                location += "GUJRANWALA,"
              
            } else if (District == 2) {
                location += "GUJRAT,"
                
            } else if (District == 3) {
                location += "HAFIZABAD,"
               
            } else if (District == 4) {
                location += "MANDI BAHAUDDIN,"
                
            } else if (District == 5) {
                location += "NAROWAL,"
                
            } else if (District == 6) {
                location += "SIALKOT,"
               
            }
        } else if (Division == 5) {
            location += "LAHORE,"
            if (District == 1) {
                location += "KASUR,"
                
            } else if (District == 2) {
                location += "LAHORE,"
               
            } else if (District == 3) {
                location += "OKARA,"
                
            } else if (District == 4) {
                location += "SHEIKHUPURA,"
                
            } else if (District == 5) {
                location += "NANKANA SAHIB,"
               
            }
        } else if (Division == 6) {
            location += "MULTAN,"
            if (District == 1) {
                location += "KHANEWAL,"
                
            } else if (District == 2) {
                location += "LODHRAN,"
                
            } else if (District == 3) {
                location += "MULTAN,"
                
            } else if (District == 4) {
                location += "PAK PATTAN,"
              
            } else if (District == 5) {
                location += "SAHIWAL,"
                
            } else if (District == 6) {
                location += "VEHARI,"
                
            }
        } else if (Division == 7) {
            location += "RAWALPINDI,"
            if (District == 1) {
                location += "ATTOCK,"
                
            } else if (District == 2) {
                location += "CHAKWAL,"
               
            } else if (District == 3) {
                location += "JHELUM,"
                
            } else if (District == 4) {
                location += "RAWALPINDI,"
               
            }
        } else if (Division == 8) {
            location += "SARGODHA,"
            if (District == 1) {
                location += "BHAKKAR,"
               
            } else if (District == 2) {
                location += "KHUSHAB,"
               
            } else if (District == 3) {
                location += "MIANWALI,"
                
            } else if (District == 4) {
                location += "SARGODHA,"
               
            }
        }
    } else if (Province == 4) {
        location += "SINDH,"
        if (Division == 1) {
            location += "HYDERABAD,"
            if (District == 1) {
                location += "BADEEN,"
                
            } else if (District == 2) {
                location += "DADU,"
                
            } else if (District == 3) {
                location += "HYDERABAD,"
                
            } else if (District == 4) {
                location += "THATTA,"
                
            } else if (District == 5) {
                location += "JAMSHORO,"
               
            } else if (District == 6) {
                location += "TANDO MUHAMMAD KHAN,"
                
            } else if (District == 7) {
                location += "TANDO ALLAHIAR,"
                
            } else if (District == 8) {
                location += "MATIYARI,"
                
            }
        } else if (Division == 2) {
            location += "KARACHI,"
           
        } else if (Division == 3) {
            location += "LARKANA,"
            if (District == 1) {
                location += "JACOBABAD,"
               
            } else if (District == 2) {
                location += "LARKANA,"
               
            } else if (District == 3) {
                location += "SHIKARPUR,"
               
            } else if (District == 4) {
                location += "QAMBAR SHAHDADKOT,"
               
            } else if (District == 5) {
                location += "KASHMOR,"
                
            }
        } else if (Division == 4) {
            location += "MIRPUR KHAS,"
            if (District == 1) {
                location += "MIRPUR KHAS,"
                
            } else if (District == 2) {
                location += "SANGHAR,"
                
            } else if (District == 3) {
                location += "THARPARKAR,"
                
            } else if (District == 4) {
                location += "UMARKOT,"
                
            }
        } else if (Division == 5) {
            location += "SUKKUR,"
            if (District == 1) {
                location += "GHOTKI,"
                
            } else if (District == 2) {
                location += "KHAIRPUR,"
               
            } else if (District == 3) {
                location += "NOSHERO FEROZ,"
              
            } else if (District == 4) {
                location += "SHAHEED BENAZIRABAD,"
             
            } else if (District == 5) {
                location += "SUKKUR,"
                
            }
        }
    } else if (Province == 5) {
        location += "BALOCHISTAN,"
        if (Division == 1) {
            location += "KALAT,"
            if (District == 1) {
                location += "AWARAN,"
                
            } else if (District == 2) {
                location += "KALAT,"
               
            } else if (District == 3) {
                location += "WASHUK,"
              
            } else if (District == 4) {
                location += "KHUZDAR,"
               
            } else if (District == 5) {
                location += "HUB,"
               
            } else if (District == 6) {
                location += "MASTUNG,"
                
            }
        } else if (Division == 2) {
            location += "MAKRAN,"
            if (District == 1) {
                location += "GAWADAR,"
                
            } else if (District == 2) {
                location += "KECH,"
                
            } else if (District == 3) location += "PANJGUR,"
        } else if (Division == 3) {
            location += "NASEERABAD,"
            if (District == 1) {
                location += "KACHI,"
                
            } else if (District == 2) {
                location += "JAFFARABAD,"
                
            } else if (District == 3) {
                location += "JHAL MAGSI,"
               
            } else if (District == 4) {
                location += "NASEERABAD,"
               
            }
        } else if (Division == 4) {
            location += "QUETTA,"
            if (District == 1) {
                location += "CHAGHI,"
              
            } else if (District == 2) {
                location += "QILA ABDULLAH,"
               
            } else if (District == 3) {
                location += "PISHIN,"
             
            } else if (District == 4) {
                location += "QUETTA,"
              
            } else if (District == 5) location += "NUSHKI,"

        } else if (Division == 5) {
            location += "SIBBI,"
            if (District == 1) {
                location += "DERA BUGTI,"
                
            } else if (District == 2) {
                location += "KOHLU,"
               
            } else if (District == 3) {
                location += "SIBBI,"
               
            } else if (District == 4) {
                location += "ZIARAT,"
               
            } else if (District == 5) {
                location += "HARNAI,"
               
            }
        } else if (Division == 6) {
            location += "ZHOB,"
            if (District == 1) {
                location += "BARKHAN,"
              
            } else if (District == 2) {
                location += "QILA SAIFULLAH,"
                
            } else if (District == 3) {
                location += "LORALAI,"
                
            } else if (District == 4) {
                location += "MUSAKHAIL,"
               
            } else if (District == 5) {
                location += "ZHOB,"
               
            } else if (District == 6) {
                location += "ZHOB,"
               
            }
        }
    } else if (Province == 6) location += "ISLAMABAD,"
    else if (Province == 7) {
        location += "GILGIT,"
        if (Division == 1) {
            if (District == 1) {
                location += "BALTISTAN,"
              
            } else if (District == 2) {
                location += "DIAMER,"
               
            } else if (District == 3) {
                location += "GHANCHAY,"
              
            } else if (District == 4) {
                location += "GHAZAR,"
               
            } else if (District == 5) {
                location += "HUNZA NAGAR,"
               
            } else if (District == 6) location += "ASTOOR,"
        }
    } else if (Province == 8) {
        location += "AZAD KASHMIR,"
        if (Division == 1) {
            location += "MIRPUR,"
            if (District == 1) {
                location += "BHIMBER"
              
            } else if (District == 2) {
                location += "KOTLI,"
             
                
            } else if (District == 3) {
                location += "MIRPUR,"
               
            }
        } else if (Division == 2) {
            location += "MUZAFFARABAD"
            if (District == 1) {
                location += "BAGH,"
              
            } else if (District == 2) {
                location += "MUZAFFARABAD,"
             
            } else if (District == 3) {
                location += "POONCH,"
           
            } else if (District == 4) {
                location += "SUDHANOTI,"
             
            } else if (District == 5) {
                location += "NEELUM,"
               
            } else if (District == 6) {
                location += "HAVELI,"
                
            } else if (District == 7) {
                location += "HATTIYAN BALA,"
              
            }
        }
    }
    return location;
}
