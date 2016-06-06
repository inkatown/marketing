package Term_rec;
    use strict;

  sub new {
        my $self  = {};
        $self->{NAME}   = undef;
        $self->{COUNTER}    = undef;
	$self->{IDCAM} = undef;
     
        bless($self);           # but see below
        return $self;
    }
   sub name {
        my $self = shift;
        if (@_) { $self->{NAME} = shift }
        return $self->{NAME};
    }

    sub counter {
        my $self = shift;
        if (@_) { $self->{COUNTER} = shift }
        return $self->{COUNTER};
    }
    
    sub idcam {
	my $self = shift;
	if (@_) { $self->{IDCAM} = shift }
	return $self->{IDCAM};
    }

1;
