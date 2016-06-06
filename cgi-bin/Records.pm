package Records;
use strict;

sub new {
	my $self = {};
	$self->{PROMURLS} =  undef;
	$self->{VISIT_DATE} = undef;
	$self->{ID} = undef;


	bless($self);
	return $self;

}

sub promurls {
	my $self = shift;
	if(@_) { $self->{PROMURLS} = shift }
	return $self->{PROMURLS};
}

sub visit_date {
	my $self =shift;
	if(@_) {$self->{VISIT_DATE} = shift }
	return $self->{VISIT_DATE};
}

sub id {
	my $self =shift;
	if(@_) {$self->{ID} = shift }
	return $self->{ID};
}
1;
