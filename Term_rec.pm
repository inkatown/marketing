package Term_rec;
    use strict;

  sub new {
        my $self  = {};
        $self->{NAME}   = undef;
        $self->{COUNTER}    = undef;
	$self->{IDCAM} = undef;
	$self->{ORISTRING} = undef;
	$self->{FINALCOUNTER} = undef;     

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
    
    sub finalcounter {
	my $self = shift;
	if(@_) { $self->{FINALCOUNTER} = shift }
	return $self->{FINALCOUNTER};
    }
    
    sub idcam {
	my $self = shift;
	if (@_) { $self->{IDCAM} = shift }
	return $self->{IDCAM};
    }
    
    sub oristring {
	my $self = shift;
	if (@_) { $self->{ORISTRING} = shift }
	return $self->{ORISTRING};
    }
1;
